import cv2
import os
from datetime import datetime
import time
import requests

# Set the endpoint URL where you want to send the captures for predictions
endpoint_url = "http://<ip_target>:5000/detections"  # Replace with the actual endpoint URL

# sumber penimpanan
path = r'C:\Users\DELL'# snapshot akan disimpan di sini

# Changing directory to the given path
os.chdir(path)

# Variable to give a unique name to images
i = 1

# sumber video
camera_url = 'your_camera_url' # Sumber video dari cctv
video = cv2.VideoCapture(camera_url)

# Set the interval for capturing frames (10 minutes = 600 seconds)
capture_interval = 600
last_capture_time = time.time()

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
    if current_time - last_capture_time >= capture_interval:
        filename = f'Frame_{i}.jpg'

        # Save the images in the given path
        try:
            cv2.imwrite(filename, img)
            i = i + 1

            # Open the saved image file and send it to the /detections endpoint
            with open(filename, 'rb') as file:
                files = {'images': file}
                response = requests.post(endpoint_url, files=files)

            # Print the response from the /detections endpoint
            print(response.text)

            # Update the last capture time
            last_capture_time = current_time
        except Exception as e:
            print(f"Error: {e}")

# Close the video file
video.release()

# Close all open windows
cv2.destroyAllWindows()
