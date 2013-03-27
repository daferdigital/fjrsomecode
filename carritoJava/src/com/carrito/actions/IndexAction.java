package com.carrito.actions;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.dao.CategoriaDAO;
import com.carrito.util.Constants;

public class IndexAction extends Action {
	private static final Logger log = Logger.getLogger(IndexAction.class);
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		//vamos a la pagina inicial
		
		//cargamos las categorias
		request.setAttribute("listaCategorias", CategoriaDAO.getAllCategories());
		
		//cargamos el posible carro que tengamos en sesion para presentarlo
		
		return mapping.findForward(Constants.MAPPING_SUCCES);
	}
}
