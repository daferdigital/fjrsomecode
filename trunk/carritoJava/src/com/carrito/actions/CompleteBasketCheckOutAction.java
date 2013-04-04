package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.forms.BasketForm;
import com.carrito.util.Constants;

/**
 * 
 * Class: CompleteBasketCheckOutAction
 * Creation Date: 04/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CompleteBasketCheckOutAction extends Action {
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		BasketForm basketForm = (BasketForm) form;
		
		return mapping.findForward(Constants.MAPPING_SUCCESS);
	}
}
