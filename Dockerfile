FROM php:7.4

RUN apt-get update && apt-get install -y --no-install-recommends \
  # binaries requested by composer
  git unzip \
  && rm -rf /var/lib/apt/lists/*

