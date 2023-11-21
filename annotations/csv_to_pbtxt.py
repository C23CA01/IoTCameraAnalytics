import csv

def csv_to_pbtxt(csv_file, pbtxt_file):
    class_set = set()

    # Read CSV file and extract unique class names
    with open(csv_file, 'r') as csvfile:
        csvreader = csv.reader(csvfile)
        next(csvreader)  # Skip header
        for row in csvreader:
            class_name = row[3]  # Assuming class is in the 4th column, adjust if needed
            class_set.add(class_name)

    # Write label map to .pbtxt file
    with open(pbtxt_file, 'w') as pbtxtfile:
        for i, class_name in enumerate(class_set, start=1):
            pbtxtfile.write('item {\n')
            pbtxtfile.write(f'\tid: {i}\n')
            pbtxtfile.write(f'\tname: "{class_name}"\n')
            pbtxtfile.write('}\n')

# Example usage
csv_file_path = 'output.csv'
pbtxt_output_path = 'annotations/labelMap.pbtxt'
csv_to_pbtxt(csv_file_path, pbtxt_output_path)
