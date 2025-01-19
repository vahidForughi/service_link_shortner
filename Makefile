build-local:
	docker build -t microservice-kickstart/service_link_shortner -f local.Dockerfile . $(args)
