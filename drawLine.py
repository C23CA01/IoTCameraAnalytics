import os
import cv2
import matplotlib.pyplot as plt
import matplotlib.patches as patches

def visualize_annotations_yolo(image_folder, annotation_folder, class_file):
    # Read class names from the classes.txt file
    with open(class_file, 'r') as f:
        classes = f.read().strip().split('\n')

    for img_file in os.listdir(image_folder):
        if img_file.endswith('.jpg'):
            img_path = os.path.join(image_folder, img_file)
            annotation_path = os.path.join(annotation_folder, img_file.replace('.jpg', '.txt'))

            # Read image
            image = cv2.imread(img_path)
            image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)

            # Create figure and axes
            fig, ax = plt.subplots(1)
            ax.imshow(image_rgb)

            # Draw bounding boxes
            box_count = 0
            with open(annotation_path, 'r') as f:
                for line in f:
                    values = line.strip().split()
                    class_id = int(values[0])
                    center_x, center_y, width, height = map(float, values[1:])

                    # Convert YOLO coordinates to xmin, ymin, xmax, ymax
                    xmin = int((center_x - width / 2) * image.shape[1])
                    ymin = int((center_y - height / 2) * image.shape[0])
                    xmax = int((center_x + width / 2) * image.shape[1])
                    ymax = int((center_y + height / 2) * image.shape[0])

                    # Define color based on class
                    color = 'g' if class_id == 0 else 'r'  # Green for class 0, Red for others

                    # Create a rectangle patch
                    rect = patches.Rectangle((xmin, ymin), xmax - xmin, ymax - ymin,
                                             linewidth=1, edgecolor=color, facecolor='none')

                    # Add the patch to the Axes
                    ax.add_patch(rect)

                    # Display class name
                    plt.text(xmin, ymin - 5, classes[class_id], color=color,
                             fontsize=8, bbox=dict(facecolor='white', alpha=0.7))

                    box_count += 1

            # Display box count
            plt.text(10, 10, f'Box Count: {box_count}', color='black',
                     fontsize=12, bbox=dict(facecolor='white', alpha=0.7))

            plt.axis('off')
            plt.show()

# Define paths
image_folder_path = 'framecapt/yoloImage/'
annotation_folder_path = 'framecapt/yoloImage/'
class_file_path = 'framecapt/yoloImage/classes.txt'

# Visualize YOLO annotations
visualize_annotations_yolo(image_folder_path, annotation_folder_path, class_file_path)
