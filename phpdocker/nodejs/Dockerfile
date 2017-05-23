FROM node:6.10.3

WORKDIR "/application"

RUN mkdir -p public/dist

ADD package.json package.json
ADD bower.json bower.json
ADD build build
ADD theme theme

RUN npm install -g bower
RUN npm install
RUN bower install --config.interactive=false --allow-root

CMD npm run deploy
