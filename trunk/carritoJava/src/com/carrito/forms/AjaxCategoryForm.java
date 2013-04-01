package com.carrito.forms;

import org.apache.struts.action.ActionForm;

/**
 * 
 * Class: AjaxCategoryForm
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class AjaxCategoryForm extends ActionForm{
	/**
	 * 
	 */
	private static final long serialVersionUID = -5904434727999265809L;
	
	private int categoryId;
	private int pageNumber;
	private String customAjaxPagingFunctionName;
	
	public AjaxCategoryForm() {
		// TODO Auto-generated constructor stub
	}

	public int getCategoryId() {
		return categoryId;
	}

	public void setCategoryId(int categoryId) {
		this.categoryId = categoryId;
	}

	public int getPageNumber() {
		return pageNumber;
	}

	public void setPageNumber(int pageNumber) {
		this.pageNumber = pageNumber;
	}
	
	public String getCustomAjaxPagingFunctionName() {
		return customAjaxPagingFunctionName;
	}
	
	public void setCustomAjaxPagingFunctionName(
			String customAjaxPagingFunctionName) {
		this.customAjaxPagingFunctionName = customAjaxPagingFunctionName;
	}
}
