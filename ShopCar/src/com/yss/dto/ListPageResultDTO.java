package com.yss.dto;

import java.util.List;

/**
 * 
 * Class: ListPageResultDTO
 * Creation Date: 07/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ListPageResultDTO<E> {
	private int totalRecords;
	private List<E> pageElements;
	
	/**
	 * 
	 * @param totalRecords
	 * @param pageElements
	 */
	public ListPageResultDTO(int totalRecords, List<E> pageElements) {
		// TODO Auto-generated constructor stub
		this.totalRecords = totalRecords;
		this.pageElements = pageElements;
	}

	public int getTotalRecords() {
		return totalRecords;
	}

	public void setTotalRecords(int totalRecords) {
		this.totalRecords = totalRecords;
	}

	public List<E> getPageElements() {
		return pageElements;
	}

	public void setPageElements(List<E> pageElements) {
		this.pageElements = pageElements;
	}
}
