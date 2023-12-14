#!/bin/bash

# Specify the directory where your CSS files are located
css_directory="../mywebsite/stili"

# Use find to locate all CSS files in the specified directory
css_files=$(find "$css_directory" -type f -name "*.css")

# Iterate through each CSS file and comment out existing code
for file in $css_files
do
  # Add comments at the beginning and end of the file
  echo "/* Commenting existing code in $file */" > "$file"
  cat "$file" >> "$file"  # Append existing code to the file
  echo "/* End of existing code in $file */" >> "$file"
done

echo "Existing CSS code commented in all CSS files in $css_directory"
