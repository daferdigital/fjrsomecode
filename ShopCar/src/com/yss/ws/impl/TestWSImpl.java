package com.yss.ws.impl;

import javax.jws.WebService;

//Service Implementation Bean
@WebService(endpointInterface = "com.yss.ws.impl.TestWS")
public class TestWSImpl implements TestWS{

	@Override
	public void sayHello(String name) {
		// TODO Auto-generated method stub
		System.out.println("Hello " + name);
	}

}
