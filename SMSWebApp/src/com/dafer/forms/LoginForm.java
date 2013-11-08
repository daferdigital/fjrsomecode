package com.dafer.forms;

import org.apache.struts.action.ActionForm;

public class LoginForm extends ActionForm{
	/**
	 * 
	 */
	private static final long serialVersionUID = 571644054057868771L;
	
	private String login;
	private String password;
	
	public LoginForm() {
		// TODO Auto-generated constructor stub
	}

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}
}
