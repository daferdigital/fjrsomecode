package com.yss.javabeans.view;

/**
 * 
 * Class: SiteBean
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class SiteBean {
	/**
	 * Propiedad usada para indicar la ruta base de nuestra aplicacion.
	 */
	private String rootSiteURL;
	
	public SiteBean() {
		// TODO Auto-generated constructor stub
	}
	
	public void setRootSiteURL(String rootSiteURL) {
		this.rootSiteURL = rootSiteURL;
	}
	
	public String getRootSiteURL() {
		return rootSiteURL;
	}
	
	@Override
	public boolean equals(Object obj) {
		// TODO Auto-generated method stub
		if(obj instanceof SiteBean){
			return super.equals(obj);
		} else {
			return false;
		}
	}
}
