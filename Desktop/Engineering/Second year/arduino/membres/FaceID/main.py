import cv2
import sys
import time
from simple_facerec import SimpleFacerec


def detect_faces_and_return_name():
    # Temporarily redirect stdout and stderr to suppress messages during initialization
    stdout_orig = sys.stdout
    stderr_orig = sys.stderr
    sys.stdout = sys.stderr = open('NUL', 'w')

    # Encode faces from a folder
    sfr = SimpleFacerec()
    sfr.load_encoding_images("D:/MyShit/PycharmProjects/FaceID/images/")

    # Restore original stdout and stderr
    sys.stdout = stdout_orig
    sys.stderr = stderr_orig

    # Open the camera
    cap = cv2.VideoCapture(0)

    detected_name = None  # Initialize detected_name variable

    while True:
        ret, frame = cap.read()

        # Detect faces
        face_locations, face_names = sfr.detect_known_faces(frame)

        # If faces are detected, set the detected name
        if face_names:
            detected_name = face_names[0]
            break  # Exit the loop if a face is detected

        # Display the frame with detected faces
        for face_loc, name in zip(face_locations, face_names):
            top, left, bottom, right = face_loc[0], face_loc[1], face_loc[2], face_loc[3]

            cv2.putText(frame, name, (right, top - 10), cv2.FONT_HERSHEY_DUPLEX, 1, (0, 0, 200), 2)
            cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 200), 2)

        cv2.imshow('frame', frame)

        key = cv2.waitKey(1)
        if key == 27:
            break

    # Release the camera and close all OpenCV windows

    cap.release()
    cv2.destroyAllWindows()

    return detected_name


# Call the function to detect faces and return the name
detected_name = detect_faces_and_return_name()
print(detected_name)
