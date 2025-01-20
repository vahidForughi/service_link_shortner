DOCKER_IMAGE_BASE_VERSION=1.0.0

build-base:
	Tag="microservice-kickstart/service_link_shortner_base:${DOCKER_IMAGE_BASE_VERSION}"
	@if [ -n "$(docker images -q ${Tag})" ]; then \
		docker build -t ${Tag} -f base.Dockerfile . $(args); \
	fi
build-local:
	docker build -t microservice-kickstart/service_link_shortner_local -f local.Dockerfile . --build-arg="DOCKER_IMAGE_BASE_VERSION=${DOCKER_IMAGE_BASE_VERSION}" $(args)
build-stage:
	docker build -t microservice-kickstart/service_link_shortner_stage -f stage.Dockerfile . --build-arg="DOCKER_IMAGE_BASE_VERSION=${DOCKER_IMAGE_BASE_VERSION}" $(args)
