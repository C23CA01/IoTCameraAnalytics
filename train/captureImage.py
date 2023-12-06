import cv2
import os
from datetime import datetime
from objMotorPicker import posisiMotor

# set path in which you want to save images
path = r'C:\Users\DELL\Desktop\ParkingDetection\framecapt'

# changing directory to the given path
os.chdir(path)

# i variable is to give a unique name to images
i = 1
wait = 0

# Open the video file
video = cv2.VideoCapture(r'C:\Users\DELL\Desktop\ParkingDetection\video\mcr.mp4')  # Specify the path to your video file here

while True:
    # Read the video by the read() function, which will extract and return the frame
    ret, img = video.read()

    if not ret:
        break  # Break the loop when the video ends

    # Put the current DateTime on each frame
    font = cv2.FONT_HERSHEY_PLAIN
    cv2.putText(img, str(datetime.now()), (20, 40), font, 2, (255, 255, 255), 2, cv2.LINE_AA)

    # Display the image
    cv2.imshow('live video', img)

    # wait for the user to press any key
    key = cv2.waitKey(100)

    # The wait variable is used to calculate waiting time
    wait = wait + 100

    if key == ord('q'):
        break

    # When it reaches 5000 milliseconds, save that frame in the given folder
    if wait == 5000:
        filename = f'Frame_{i}.jpg'

        # Save the images in the given path
        cv2.imwrite(filename, img)
        i = i + 1
        wait = 0

# Close the video file
video.release()

# Close all open windows
cv2.destroyAllWindows()
