ln ../src/01-01-notice-for-non-valid-array-container.php .
docker build -t php72-app .
docker run -it --rm --name running72-app php72-app

# docker run -it --rm --name running72-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.2.12-cli php 01-01-notice-for-non-valid-array-container.php