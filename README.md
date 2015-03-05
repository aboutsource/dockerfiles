# Campact Dockerfiles

In this repos we collect all services we gonna share in our projects.
Each service should be deployed to campact registry on *dr.campact.de*

## build and push

building

    docker build -t dr.campact.de/mailcatcher mailcatcher/

pushing

    docker push dr.campact.de/mailcatcher
