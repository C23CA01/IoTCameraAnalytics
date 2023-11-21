# dari dataset/allimages dimana yang mempunyai spasang (x gambar dan y annots)
# tujuannya mengenerate 1 gambar tersbut beserta 1 annotsnya mapping menjadi format.pbtxt
# nantinya file hasil generate tersebut untuk jadi format TFRecord
# mendistribusikan ke train and test format .record
import os
import csv
import xml.etree.ElementTree as ET

def xml_to_csv(xml_folder, csv_file):
    with open(csv_file, 'w', newline='') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(['filename', 'width', 'height', 'class', 'xmin', 'ymin', 'xmax', 'ymax'])

        for xml_file in os.listdir(xml_folder):
            if xml_file.endswith('.xml'):
                xml_path = os.path.join(xml_folder, xml_file)
                tree = ET.parse(xml_path)
                root = tree.getroot()

                filename = root.find('filename').text
                width = int(root.find('size/width').text)
                height = int(root.find('size/height').text)

                for obj in root.findall('object'):
                    class_name = obj.find('name').text
                    bbox = obj.find('bndbox')
                    xmin = int(bbox.find('xmin').text)
                    ymin = int(bbox.find('ymin').text)
                    xmax = int(bbox.find('xmax').text)
                    ymax = int(bbox.find('ymax').text)

                    csvwriter.writerow([filename, width, height, class_name, xmin, ymin, xmax, ymax])

# Example usage
xml_folder_path = 'dataset/train/'
csv_output_path = 'output.csv'
xml_to_csv(xml_folder_path, csv_output_path)

