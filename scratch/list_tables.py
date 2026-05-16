import re

file_path = r'c:\xampp\htdocs\laravel\dcdhaka.srsibd.com-2-main\upms\almsgov_upms.sql'
tables = []
with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
    for line in f:
        match = re.search(r'CREATE TABLE `([^`]+)`', line)
        if match:
            tables.append(match.group(1))

print("Found tables:", tables)
