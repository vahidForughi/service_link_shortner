build-local:
	docker build -t service_starter/link_shortner -f local.Dockerfile . $(args)
