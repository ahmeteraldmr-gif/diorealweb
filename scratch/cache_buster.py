import os
import glob

views_dir = 'resources/views'
for filepath in glob.glob(os.path.join(views_dir, '*.blade.php')):
    with open(filepath, 'r') as f:
        content = f.read()
    
    # Add ?v=2 to js and css includes to bust cache globally
    content = content.replace('.js"', '.js?v=2"')
    content = content.replace('.css"', '.css?v=2"')
    content = content.replace('.js\'', '.js?v=2\'')
    content = content.replace('.css\'', '.css?v=2\'')
    
    with open(filepath, 'w') as f:
        f.write(content)
    print(f"Busted cache in {filepath}")
