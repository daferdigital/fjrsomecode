package com.carrito.actions;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.util.HashMap;
import java.util.Map;

import javax.servlet.ServletOutputStream;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.Action;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

import com.carrito.util.JasperReportsUtil;

public class ExportExcelCategoriasReportAction extends Action{
	
	@Override
	public ActionForward execute(ActionMapping mapping, ActionForm form,
			HttpServletRequest request, HttpServletResponse response)
			throws Exception {
		// TODO Auto-generated method stub
		
		String pathReport = request.getSession().getServletContext().getRealPath("/WEB-INF/plantillasReportes/VentasCategoria.jasper");
		//String pathReport = request.getSession().getServletContext().getRealPath("/WEB-INF/plantillasReportes/report1.jasper");
		String pathDest = request.getSession().getServletContext().getRealPath("/WEB-INF/resultadosReportes");
		
		Map<String, Object> parameters = new HashMap<String, Object>();
		parameters.put("dateFrom", "2013-03-01");
		parameters.put("dateTo", "2013-04-16");
		
		File report = JasperReportsUtil.fillReport(parameters , pathReport, pathDest);
		
		FileOutputStream fos = new FileOutputStream(report);
		
		response.setContentType("application/vnd.ms-excel");
		response.setHeader("Content-Disposition", "attachment;filename="+report.getName()+".xls");
		
		ServletOutputStream ouputStream = response.getOutputStream();
		ouputStream.write(fos.toString().getBytes());
		ouputStream.flush();
		ouputStream.close();
		fos.close();
		return null;
	}
}
