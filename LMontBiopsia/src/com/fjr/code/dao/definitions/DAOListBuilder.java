package com.fjr.code.dao.definitions;

import java.util.List;

/**
 * 
 * Class: DAOListBuilder
 * Creation Date: 31/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public interface DAOListBuilder<E> {
	
	/**
	 * Retornamos el listado de parametros relacionados con el objeto
	 * que implemente la interfaz.
	 * 
	 * @return
	 */
	public List<Object> getParameters();
	
	/**
	 * Retornamos el query a ejecutar relacionado con el objeto
	 * que implemente la interfaz.
	 * 
	 * @return
	 */
	public String getQuery();
	
	/**
	 * 
	 * @return
	 */
	public List<E> getResults();
}
