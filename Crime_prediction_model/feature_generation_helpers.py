import numpy as np
import pandas as pd


# monthly mean number of crimes
def MeanNumberOfCrimes(frame):
    """
    function:
    input:
    output:
    """
    return frame[['id', 'Count']].groupby(['id']).mean()


# monthly normalized number of crimes
def NormalizedNumberOfCrimes(frame):
    """
    function:
    input:
    output:
    """
    df = frame[['id', 'Count']].groupby(['id']).sum()
    return df / df['Count'].max()


# rank based on monthly normalized number of crimes
def RankGrids(frame):
    """
    function:
    input:
    output:
    """
    df = NormalizedNumberOfCrimes(frame)
    df['rank'] = df.rank(ascending=False)
    return df['rank']


# hotspot frequency of the grid
def HotspotFrequency(frame, numberOfHotspots):
    """
    function:
    input:
    output:
    """
    df = frame.groupby('id')['HotSpot'].sum().to_frame()
    return df


# hotspot history
def HotspotHistory(frame, numberOfHotspots):
    """
    function:
    input:
    output:
    """
    df = HotspotFrequency(frame, numberOfHotspots)
    df['HotSpot'] = np.where(df['HotSpot'] > 0, 1, 0)
    return df


# total crimes in the neighbors in last 1 month
def CrimesNeighborSum_1(row, frame):
    """
    function:
    input:
    output:
    """
    # getting the neighbor ids for a grid
    neighboringIds = row['NEIGHBORS'].split(",")
    # getting the rows corresponding to the neighbors in 1 month prior
    neighborRows = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 1) & (frame['id'].isin(neighboringIds))]
    return sum(neighborRows['Count'])


# total crimes in the neighbors in last 2 month
def CrimesNeighborSum_2(row, frame):
    """
    function:
    input:
    output:
    """
    # getting the neighbor ids for a grid
    neighboringIds = row['NEIGHBORS'].split(",")
    # getting the rows corresponding to the neighbors in 1 month prior
    neighborRows1 = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 1) & (frame['id'].isin(neighboringIds))]
    # getting the rows corresponding to the neighbors in 2 month prior
    neighborRows2 = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 2) & (frame['id'].isin(neighboringIds))]
    return sum(neighborRows1['Count']) + sum(neighborRows2['Count'])


# total crimes in the neighbors in last 3 month
def CrimesNeighborSum_3(row, frame):
    """
    function:
    input:
    output:
    """
    # getting the neighbor ids for a grid
    neighboringIds = row['NEIGHBORS'].split(",")
    # getting the rows corresponding to the neighbors in 1 month prior
    neighborRows1 = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 1) & (frame['id'].isin(neighboringIds))]
    # getting the rows corresponding to the neighbors in 2 month prior
    neighborRows2 = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 2) & (frame['id'].isin(neighboringIds))]
    # getting the rows corresponding to the neighbors in 3 month prior
    neighborRows3 = frame[
        (frame['twOverAllYears'] == row['twOverAllYears'] - 3) & (frame['id'].isin(neighboringIds))]
    return sum(neighborRows1['Count']) + sum(neighborRows2['Count']) + sum(neighborRows3['Count'])


# feature engineering for the crime dataset
def feature_engineering(EntireFrame, number_of_hotspots):
    """
    function:
    input:
    output:
    """
    # getting the hotspot crime dataframe
    HotSpotFrame = AddHotSpotColumnToData(EntireFrame, number_of_hotspots)

    # getting the max and min time_window in the dataset
    twMax = int(EntireFrame['twOverAllYears'].max())
    twMin = int(EntireFrame['twOverAllYears'].min()) + 3

    # seting the month window for calculating the statistical features for the crime data points
    windows = [1, 2, 3]
    EntireFeatureFrame = pd.DataFrame()
    for tw in range(twMin, twMax + 1):
        features = pd.DataFrame(data=EntireFrame['id'].unique(), columns=['id'])
        for i in windows:
            frame = EntireFrame[
                (EntireFrame['twOverAllYears'] >= tw - i) & (EntireFrame['twOverAllYears'] < tw)]
            hsframe = HotSpotFrame[
                (HotSpotFrame['twOverAllYears'] >= tw - i) & (HotSpotFrame['twOverAllYears'] < tw)]

            features = features.merge(MeanNumberOfCrimes(frame).reset_index(), left_on='id', right_on='id')
            features = features.rename(columns={'Count': 'mean' + str(i)})
            features = features.merge(NormalizedNumberOfCrimes(frame).reset_index(), left_on='id', right_on='id')
            features = features.rename(columns={'Count': 'norm' + str(i)})
            features = features.merge(RankGrids(frame).reset_index(), left_on='id', right_on='id')
            features = features.rename(columns={'rank': 'rank' + str(i)})
            features = features.merge(HotspotFrequency(hsframe, number_of_hotspots).reset_index(), left_on='id',
                                      right_on='id')
            features = features.rename(columns={'HotSpot': 'HotSpot' + str(i)})
            features = features.merge(HotspotHistory(hsframe, number_of_hotspots).reset_index(), left_on='id',
                                      right_on='id')
            features = features.rename(columns={'HotSpot': 'HotSpotFreq' + str(i)})

        features['twOverAllYears'] = tw
        EntireFeatureFrame = EntireFeatureFrame.append(features)

    return EntireFeatureFrame


# add hotspot column to dataframe
def AddHotSpotColumnToData(frame, numberOfHotspots):
    """
    function:
    input:
    output:
    """
    frame['HotSpot'] = 0
    # calculating the hotspot threshold value for specific month
    thresholdValues = frame.groupby('twOverAllYears').apply(
        lambda grp: grp.sort_values(by='Normalized Crimes', ascending=False).iloc[numberOfHotspots - 1][
            'Normalized Crimes'])
    frame['thresh'] = thresholdValues[frame['twOverAllYears']].values
    # determing whether a grid is hotspot or not based on the monthly threshold value
    frame['HotSpot'] = np.where(frame['Normalized Crimes'] >= frame['thresh'], 1, 0)
    return frame[['id', 'twOverAllYears', 'HotSpot']]


# bucketing the crime data based on crime count
def AddBucketColumnToData(frame, time_window):
    """
    function:
    input:
    output:
    """
    # time_window: daily
    if time_window == 'day':
        # buckets for 2 level classification for daily
        frame['CrimeBucket_1'] = pd.cut(frame['Count'], [-1, 0, 10000], labels=['zero', 'non-zero'])
        frame['CrimeBucket_2'] = pd.cut(frame['Count'], [0, 1, 2, 3, 4, 7, 10000], labels=['1', '2', '3', '4', '5', '6'])

    # time_window: weekly
    if time_window == 'week':
        # buckets for 2 level classification for weekly
        frame['CrimeBucket_1'] = pd.cut(frame['Count'], [-1, 0, 10000], labels=['zero', 'non-zero'])
        frame['CrimeBucket_2'] = pd.cut(frame['Count'], [0, 3, 5, 9, 13, 33, 10000], labels=['1', '2', '3', '4', '5', '6'])

    # time_window: monthlyly
    if time_window == 'month':
        # buckets for 2 level classification for monthly
        frame['CrimeBucket_1'] = pd.cut(frame['Count'], [-1, 0, 10000], labels=['zero', 'non-zero'])
        # frame['CrimeBucket_2'] = pd.cut(frame['Count'], [0, 7, 15, 28, 41, 103, 10000], labels=['1', '2', '3', '4', '5', '6'])
        frame['CrimeBucket_2'] = pd.cut(frame['Count'], [0, 3, 11, 24, 54, 141, 10000], labels=['1', '2', '3', '4', '5', '6'])

    return frame[['id', 'twOverAllYears', 'CrimeBucket_1', 'CrimeBucket_2']]


def CrimeInfoPreprocessing(grid_month_crime_info):
    grid_month_crime_info.columns = ['id', 'twOverAllYears', 'Count', 'area', 'Normalized Crimes']
    grid_month_crime_info['id'] = pd.to_numeric(grid_month_crime_info['id'])
    grid_month_crime_info['twOverAllYears'] = pd.to_numeric(grid_month_crime_info['twOverAllYears'])
    grid_month_crime_info['Count'] = pd.to_numeric(grid_month_crime_info['Count'])
    grid_month_crime_info['area'] = pd.to_numeric(grid_month_crime_info['area'])
    grid_month_crime_info['Normalized Crimes'] = pd.to_numeric(grid_month_crime_info['Normalized Crimes'])

    return grid_month_crime_info
