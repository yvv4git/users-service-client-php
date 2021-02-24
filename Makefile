gen_grpc:
	protoc -I protocol/ --php_out=src/ --grpc_out=src/ --plugin=protoc-gen-grpc=bin/grpc_php_plugin protocol/users.proto