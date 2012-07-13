package com.yss.javabeans.view;

/**
 * 
 * Class: UserSiteBean
 * Creation Date: 04/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class UserSiteBean {
	private boolean isLogged;
	private String userName;
	
	/**
	 * 
	 */
	public UserSiteBean(){
		/**/
	}
	
	public boolean isLogged() {
		return isLogged;
	}
	
	public void setLogged(boolean isLogged) {
		this.isLogged = isLogged;
	}
	
	public String getUserName() {
		return userName;
	}
	
	public void setUserName(String userName) {
		this.userName = userName;
	}
}
