package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.dao.CategoriaDAO;
import com.carrito.dto.ListPageResultDTO;
import com.carrito.dto.ProductDTO;
import com.carrito.forms.AjaxCategoryForm;
import com.carrito.util.Constants;
import com.carrito.util.PagingUtil;

/**
 * 
 * Class: ProductosAjaxAction
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ProductosAjaxAction extends Action{
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		AjaxCategoryForm requestedForm = (AjaxCategoryForm) form;
		
		ListPageResultDTO<ProductDTO> pageElements = CategoriaDAO.getProductCategoryPageItems(requestedForm.getCategoryId(),
				requestedForm.getPageNumber());
		
		request.setAttribute(Constants.PARAMETER_PAGE_LIST_ELEMENTS, pageElements);
		request.setAttribute(Constants.PARAMETER_PAGING_UTIL, new PagingUtil(request, 
				pageElements.getTotalRecords(), 
				requestedForm.getCustomAjaxPagingFunctionName()));
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
