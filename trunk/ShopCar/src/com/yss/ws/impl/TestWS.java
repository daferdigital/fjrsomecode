package com.yss.ws.impl;

import javax.jws.WebMethod;
import javax.jws.WebService;

//Service Endpoint Interface
@WebService
public interface TestWS {
	@WebMethod public void sayHello(String name);
}
