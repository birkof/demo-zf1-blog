PROJECT = \033[00;35m[birkof/zf1-blog]\033[0m

all: install

install:
	@/bin/echo -e "${PROJECT} downloading composer..." \
	&& curl -sS https://getcomposer.org/installer | php \
	&& /bin/echo -e "${PROJECT} installing dependencies..." \
	&& php composer.phar install \
	&& /bin/echo -e "${PROJECT} dependencies installed" \
	&& /bin/echo -e "${PROJECT} chmoding temporary folders" \
	&& /bin/chmod -R 0777 tmp/ \

clean:
	@rm -rf composer.lock \
	&& /bin/echo -e "${PROJECT} deleted composer.lock" \

update: composer-clean
	@ /bin/echo -e "${PROJECT} update dependencies..." \
	&& php composer.phar update $(p) \
	&& /bin/echo -e "${PROJECT} dependencies updated" \

self-update:
	@ /bin/echo -e "${PROJECT} running composer self update" \
	&& php composer.phar self-update

push-master:
	@/bin/echo -e "${PROJECT} starting push..." \
	&& git push origin master \
	&& /bin/echo -e "${PROJECT} pushed origin master" \

.PHONY: all
.PHONY: install
.PHONY: push-master
.PHONY: composer-clean composer-update composer-self-update
