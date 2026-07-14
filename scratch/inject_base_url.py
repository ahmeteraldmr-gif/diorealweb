import os
import glob

views_dir = 'resources/views'
for filepath in glob.glob(os.path.join(views_dir, '*.blade.php')):
    with open(filepath, 'r') as f:
        content = f.read()
    
    if '<meta name="base-url"' not in content:
        content = content.replace(
            '<meta name="csrf-token" content="{{ csrf_token() }}">',
            '<meta name="csrf-token" content="{{ csrf_token() }}">\n    <meta name="base-url" content="{{ url(\'/\') }}">'
        )
        with open(filepath, 'w') as f:
            f.write(content)
        print(f"Updated {filepath}")
    else:
        print(f"Skipped {filepath} (already injected)")
