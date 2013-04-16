package com.carrito.actions;

import java.io.File;
import java.io.FileInputStream;
import java.util.HashMap;
import java.util.Map;

import javax.servlet.ServletOutputStream;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.forms.VentasCategoriaForm;
import com.carrito.util.JasperReportsUtil;

public class ExportExcelInventarioReportAction extends Action{
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		VentasCategoriaForm reportForm = (VentasCategoriaForm) form;
		
		String pathReport = request.getSession().getServletContext().getRealPath("/WEB-INF/plantillasReportes/Inventario.jasper");
		String pathDest = request.getSession().getServletContext().getRealPath("/WEB-INF/resultadosReportes");
		
		Map<String, Object> parameters = new HashMap<String, Object>();
		parameters.put("dateFrom", reportForm.getDateFrom());
		parameters.put("dateTo", reportForm.getDateTo());
		
		File report = JasperReportsUtil.fillReport(parameters , pathReport, pathDest);
		FileInputStream fis = new FileInputStream(report);
		//FileOutputStream fos = new FileOutputStream(report);
		
		response.setContentType("application/vnd.ms-excel");
		response.setHeader("Content-Disposition", "attachment;filename="+report.getName());
		response.setHeader("content-transfer-encoding", "binary");
		
		ServletOutputStream ouputStream = response.getOutputStream();
		byte[] b = new byte[4096];
		
		while (fis.read(b) != -1) {
			ouputStream.write(b);
		}
		
		ouputStream.flush();
		ouputStream.close();
		fis.close();
		return null;
	}
}
