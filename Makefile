build-local:
	docker build -t microservice-kickstart/service_link_shortner_local -f local.Dockerfile . $(args)
build-stage:
	docker build -t microservice-kickstart/service_link_shortner_stage -f stage.Dockerfile . $(args)
