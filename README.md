1. Copy "docker/.env.dist" --> "docker/.env"
2. Copy docker/docker-compose.override.local.yml --> "docker/docker-compose.override.yml"
3. Go to "docker" directory
4. Run "bin/build.sh"
5. Run "bin/up.sh"
6. Run "bin/composer.sh install"
7. Run "bin/console.sh doctrine:migrations:migrate"
8. Run "bin/console.sh doctrine:fixtures:load"
9. Run "bin/console.sh app:crawl:jobs"
10. In your browser go to "http://localhost"