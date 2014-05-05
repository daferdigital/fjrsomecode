package com.fjr.code.dao.definitions;

/**
 * 
 * Class: TipoDiagnostico <br />
 * DateCreated: 05/05/2014 <br />
 * @author T&T <br />
 *
 */
public enum TipoDiagnostico {
	COMPLEMENTARIO("1"),
	DE_BIOPSIA("0");
	
	private String key;
	
	/**
	 * 
	 * @param key
	 */
	private TipoDiagnostico(String key) {
		// TODO Auto-generated constructor stub
		this.key = key;
	}
	
	/**
	 * 
	 * @return
	 */
	public String getKey() {
		return key;
	}
}
