import os
import cv2
import xml.etree.ElementTree as ET
import matplotlib.pyplot as plt
import matplotlib.patches as patches

# menampilkan gambar yang sudah memiliki annotasi
def visualize_annotations(image_folder, annotation_folder):
    for xml_file in os.listdir(annotation_folder):
        if xml_file.endswith('.xml'):
            xml_path = os.path.join(annotation_folder, xml_file)
            image_path = os.path.join(image_folder, xml_file.replace('.xml', '.jpg'))

            # Read image
            image = cv2.imread(image_path)
            image_rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)

            # Parse XML file
            tree = ET.parse(xml_path)
            root = tree.getroot()

            # Create figure and axes
            fig, ax = plt.subplots(1)
            ax.imshow(image_rgb)

            # Draw bounding boxes
            for obj in root.findall('object'):
                class_name = obj.find('name').text
                bbox = obj.find('bndbox')
                xmin = int(bbox.find('xmin').text)
                ymin = int(bbox.find('ymin').text)
                xmax = int(bbox.find('xmax').text)
                ymax = int(bbox.find('ymax').text)

                # Define color based on class
                if class_name == 'free':
                    color = 'g'  # Green for 'free'
                elif class_name == 'used':
                    color = 'r'  # Red for 'used'
                else:
                    color = 'w'  # White for other classes (modify as needed)

                # Create a rectangle patch
                rect = patches.Rectangle((xmin, ymin), xmax - xmin, ymax - ymin, linewidth=1, edgecolor=color, facecolor='none')

                # Add the patch to the Axes
                ax.add_patch(rect)

                # Display class name
                plt.text(xmin, ymin - 5, class_name, color=color, fontsize=8, bbox=dict(facecolor='white', alpha=0.7))

            plt.axis('off')
            plt.show()

# draw antara 
image_folder_path = 'dataset/train/'
annotation_folder_path = 'dataset/train/'
visualize_annotations(image_folder_path, annotation_folder_path)
