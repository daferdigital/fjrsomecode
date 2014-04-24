package com.fjr.code.util;

import java.awt.AWTException;
import java.awt.Robot;
import java.awt.event.KeyEvent;
import java.io.File;
import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;
import javax.swing.JOptionPane;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.HistologiaIHQPanel;
import com.fjr.code.gui.HistologiaPanel;
import com.fjr.code.gui.InformeImpresoDialog;
import com.fjr.code.gui.IngresoPanel;
import com.fjr.code.gui.MacroscopicaPanel;
import com.fjr.code.gui.MicroscopicaPanel;
import com.fjr.code.gui.PrepareDiagnosticoDialog;

/**
 * 
 * Class: OpenBiopsiaUtil
 * Creation Date: 27/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class OpenBiopsiaUtil {
	private static final Logger log = Logger.getLogger(OpenBiopsiaUtil.class);
	
	/**
	 * 
	 * @param numero
	 */
	public static void openBiopsia(String numero) {
		// TODO Auto-generated method stub
		BiopsiaInfoDTO biopsia = BiopsiaInfoDAO.getBiopsiaByNumero(numero);
		
		if(biopsia == null){
			JOptionPane.showMessageDialog(null, 
					"La biopsia de numero " + numero + " no fue encontrada en el sistema", 
					"Biopsia " + numero + " no encontrada", 
					JOptionPane.ERROR_MESSAGE);
		} else {
			//vemos la fase de la biopsia para saber que frame abrir
			if(FasesBiopsia.INFORME_IMPRESO.equals(biopsia.getFaseActual())
					|| FasesBiopsia.MATERIAL_ENTREGADO.equals(biopsia.getFaseActual())){
				//abriendo biopsia en fase de informe ya impreso
				//traemos el ultimo informe impreso al disco
				final String query = "SELECT ultimo_informe_impreso FROM biopsias WHERE id=?";
				List<Object> parameters = new LinkedList<Object>();
				parameters.add(biopsia.getId());
				
				CachedRowSet rows = DBUtil.executeSelectQuery(query, parameters);
				try {
					if(rows.next()){
						File diagnostico = new File(Constants.TMP_PATH + File.separator + Constants.PREFIJO_PDF_INFORME + biopsia.getId() + ".pdf");
						BLOBUtil.writeBLOBToDisk(diagnostico, 
								rows.getBytes(1));
						
						new InformeImpresoDialog(diagnostico.getAbsolutePath(), biopsia.getCodigo()).setVisible(true);
					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			} else if(FasesBiopsia.ENTREGA.equals(biopsia.getFaseActual())){
				new PrepareDiagnosticoDialog(biopsia.getCodigo()).setVisible(true);
			} else if(FasesBiopsia.INGRESO.equals(biopsia.getFaseActual())){
				IngresoPanel panel = new IngresoPanel(false);
				AppWindow.getInstance().setPanelContenido(panel, (FasesBiopsia) null);
				AppWindow.getInstance().setExtraTitle("Recepci\u00F3n");
				panel.getTextNroBiopsia().setText(biopsia.getCodigo());
				panel.getTextNroBiopsia().requestFocusInWindow();
				simulateKeyPress(KeyEvent.VK_ENTER);
			} else if(FasesBiopsia.MACROSCOPICA.equals(biopsia.getFaseActual())){
				MacroscopicaPanel panel = new MacroscopicaPanel();
				AppWindow.getInstance().setExtraTitle("Macrosc\u00F3pica");
				AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.MACROSCOPICA);
				panel.getTextNroBiopsia().setText(biopsia.getCodigo());
				panel.setFocusAtDefaultElement();
				simulateKeyPress(KeyEvent.VK_ENTER);
			} else if(FasesBiopsia.HISTOLOGIA.equals(biopsia.getFaseActual())){
				HistologiaPanel panel = new HistologiaPanel();
				AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.HISTOLOGIA);
				AppWindow.getInstance().setExtraTitle("Histologia");
				panel.getTextNroBiopsia().setText(biopsia.getCodigo());
				panel.setFocusAtDefaultElement();
				simulateKeyPress(KeyEvent.VK_ENTER);
			} else if(FasesBiopsia.MICROSCOPICA.equals(biopsia.getFaseActual())){
				MicroscopicaPanel panel = new MicroscopicaPanel();
				AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.MICROSCOPICA);
				AppWindow.getInstance().setExtraTitle("Microscopica");
				panel.getTextNroBiopsia().setText(biopsia.getCodigo());
				panel.setFocusAtDefaultElement();
				simulateKeyPress(KeyEvent.VK_ENTER);
			} else if(FasesBiopsia.IHQ.equals(biopsia.getFaseActual())){
				HistologiaIHQPanel panel = new HistologiaIHQPanel();
				AppWindow.getInstance().setPanelContenido(panel, FasesBiopsia.IHQ);
				AppWindow.getInstance().setExtraTitle("IHQ");
				panel.getTextNroBiopsia().setText(biopsia.getCodigo());
				panel.setFocusAtDefaultElement();
				simulateKeyPress(KeyEvent.VK_ENTER);
			} else {
				log.error("No se ha realizado el mapeo del tipo de fase "
						+ biopsia.getFaseActual());
			}
		}
	}
	
	/**
	 * 
	 * @param virtualKey
	 */
	private static void simulateKeyPress(int virtualKey){
		try {
	        Robot robot = new Robot();

	        // Simulate a key press
	        robot.keyPress(virtualKey);
	        robot.keyRelease(virtualKey);
		} catch (AWTException e) {
	        //e.printStackTrace();
		}
	}
}
