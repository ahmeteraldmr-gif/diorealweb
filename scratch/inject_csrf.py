import os

views_dir = '/Users/boztech/Desktop/Projeler/Dioreal_dijital/resources/views'
csrf_meta = '    <meta name="csrf-token" content="{{ csrf_token() }}">'

for filename in os.listdir(views_dir):
    if filename.endswith('.blade.php'):
        filepath = os.path.join(views_dir, filename)
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Check if already injected
        if 'csrf-token' in content:
            print(f"{filename} already has csrf-token, skipping.")
            continue
            
        if '<head>' in content:
            updated_content = content.replace('<head>', f'<head>\n{csrf_meta}')
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(updated_content)
            print(f"Injected csrf-token into {filename}")
        else:
            print(f"No <head> tag found in {filename}")
