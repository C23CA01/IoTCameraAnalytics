import cv2
import os
from datetime import datetime
import time
import requests

# Set the endpoint URL where you want to send the captures for predictions
endpoint_url = "http://your_server_ip:your_server_port/detections"  # Replace with the actual endpoint URL

# Set the path in which you want to save images
path = r'C:\Users\DELL\Desktop\ParkingDetection\framecapt'

# Changing directory to the given path
os.chdir(path)

# Variable to give a unique name to images
i = 1

# Open the video file
video = cv2.VideoCapture(r'C:\Users\DELL\Desktop\ParkingDetection\video\mcr.mp4')  # Specify the path to your video file here

# Set the interval for capturing frames (10 minutes = 600 seconds)
capture_interval = 600

while True:
    # Read the video by the read() function, which will extract and return the frame
    ret, img = video.read()

    if not ret:
        break  # Break the loop when the video ends

    # Display the image without the timestamp watermark
    cv2.imshow('live video', img)

    # Wait for the user to press any key
    key = cv2.waitKey(100)

    if key == ord('q'):
        break

    # Get the current time
    current_time = time.time()

    # Check if 10 minutes have passed since the last capture
    if current_time % capture_interval < 1:
        filename = f'Frame_{i}.jpg'

        # Save the images in the given path
        cv2.imwrite(filename, img)
        i = i + 1

        # Open the saved image file and send it to the /detections endpoint
        with open(filename, 'rb') as file:
            files = {'images': file}
            response = requests.post(endpoint_url, files=files)

        # Print the response from the /detections endpoint
        print(response.text)

# Close the video file
video.release()

# Close all open windows
cv2.destroyAllWindows()
