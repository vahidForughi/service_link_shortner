build-base:
	docker build -t microservice-kickstart/service_link_shortner_base:1.0.0 -f base.Dockerfile . $(args)
build-local:
	docker build -t microservice-kickstart/service_link_shortner_local -f local.Dockerfile . $(args)
build-stage:
	docker build -t microservice-kickstart/service_link_shortner_stage -f stage.Dockerfile . $(args)
