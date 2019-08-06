ln ../src/01-01-notice-for-non-valid-array-container.php .
ln ../src/01-02-get-declared-classes.php .
ln ../src/01-03-fn-reserved-keyword.php .
ln ../src/01-04-list-assignment-by-reference.php .
ln ../src/01-05-php-opening-tag-at-eof.php .
ln ../src/02-01-typed-properties.php .
ln ../src/02-02-arrow-functions-7-4.php .
docker build -t php74-app .
docker run -it --rm --name running74-app php74-app

# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 01-01-notice-for-non-valid-array-container.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 01-02-get-declared-classes.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 01-03-fn-reserved-keyword.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 01-04-list-assignment-by-reference.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 01-05-php-opening-tag-at-eof.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 02-01-typed-properties.php
# docker run -it --rm --name running74-app -v "$PWD":/usr/local/src/myapp -w /usr/local/src/myapp php:7.4.0beta1-cli php 02-02-arrow-functions-7-4.php