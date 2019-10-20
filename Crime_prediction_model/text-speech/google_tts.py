# Import the required module for text
# to speech conversion
from gtts import gTTS
import playsound

# This module is imported so that we can
# play the converted audio
import os

lat = '123'
lon = '342'
# The text that you want to convert to audio
mytext = 'Attention All units tighten security at latitude'+lat+'and longitude'+lon

# Language in which you want to convert
language = 'en'

# Passing the text and language to the engine,
# here we have marked slow=False. Which tells
# the module that the converted audio should
# have a high speed
myobj = gTTS(text=mytext, lang=language, slow=False)

# Saving the converted audio in a mp3 file named
# welcome
myobj.save("warning.mp3")
playsound.playsound('./warning.mp3', True)