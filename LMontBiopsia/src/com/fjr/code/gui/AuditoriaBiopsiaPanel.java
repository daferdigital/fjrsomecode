package com.fjr.code.gui;

import javax.swing.JPanel;
import javax.swing.JLabel;

import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import com.fjr.code.dao.AuditoriaBiopsiaDAO;
import com.fjr.code.dao.definitions.CriterioBusquedaBiopsia;
import com.fjr.code.dao.definitions.Meses;
import com.fjr.code.dto.AuditoriaBiopsiaDTO;
import com.fjr.code.gui.tables.JTableAuditoriaBiopsia;
import com.fjr.code.util.Constants;

import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JButton;
import javax.swing.SwingConstants;

/**
 * 
 * Class: BusquedaBiopsiaPanel
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class AuditoriaBiopsiaPanel extends JPanel implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 3518439321990846678L;
	private static final String ACTION_COMMAND_BUSCAR = "buscar";
	private JComboBox comboDiaDesde;
	private JComboBox comboMesDesde;
	private JTextField textYearDesde;
	private JComboBox comboDiaHasta;
	private JComboBox comboMesHasta;
	private JTextField textYearHasta;

	/**
	 * Create the panel.
	 */
	public AuditoriaBiopsiaPanel() {
		setLayout(null);
		setSize(1000, 50);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JButton btnBuscar = new JButton("Buscar");
		btnBuscar.setActionCommand(ACTION_COMMAND_BUSCAR);
		btnBuscar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnBuscar.setBounds(812, 9, 89, 23);
		btnBuscar.addActionListener(this);
		add(btnBuscar);
		
		JLabel lblfechaDesde = new JLabel("<html><b>Fecha Desde:</b></html>");
		lblfechaDesde.setHorizontalAlignment(SwingConstants.RIGHT);
		lblfechaDesde.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblfechaDesde.setBounds(10, 11, 152, 16);
		add(lblfechaDesde);
		
		comboDiaDesde = new JComboBox();
		comboDiaDesde.setBounds(192, 11, 42, 20);
		for (int i = 1; i < 32; i++) {
			comboDiaDesde.addItem(i < 10 ? "0" + i: i);
		}
		add(comboDiaDesde);
		
		comboMesDesde = new JComboBox();
		comboMesDesde.setBounds(244, 11, 111, 20);
		for (int i = 0; i < Meses.values().length; i++) {
			comboMesDesde.addItem(Meses.values()[i]);
		}
		add(comboMesDesde);
		
		textYearDesde = new JTextField();
		textYearDesde.setBounds(377, 11, 47, 20);
		add(textYearDesde);
		textYearDesde.setColumns(10);
		
		JLabel lblfechaHasta = new JLabel("<html><b>Fecha Hasta:</b></html>");
		lblfechaHasta.setHorizontalAlignment(SwingConstants.RIGHT);
		lblfechaHasta.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblfechaHasta.setBounds(389, 11, 152, 16);
		add(lblfechaHasta);
		
		comboDiaHasta = new JComboBox();
		comboDiaHasta.setBounds(572, 11, 42, 20);
		for (int i = 1; i < 32; i++) {
			comboDiaHasta.addItem(i < 10 ? "0" + i: i);
		}
		add(comboDiaHasta);
		
		comboMesHasta = new JComboBox();
		comboMesHasta.setBounds(623, 11, 111, 20);
		for (int i = 0; i < Meses.values().length; i++) {
			comboMesHasta.addItem(Meses.values()[i]);
		}
		add(comboMesHasta);
		
		textYearHasta = new JTextField();
		textYearHasta.setColumns(10);
		textYearHasta.setBounds(744, 11, 59, 20);
		add(textYearHasta);
		
		setVisible(true);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BUSCAR.equals(e.getActionCommand())){
			//se deben buscar las biopsias bajo el criterio indicado
			//y el valor dado
			
			Map<CriterioBusquedaBiopsia, String> valores = new HashMap<CriterioBusquedaBiopsia, String>();
			//verificamos si debemos buscar tambien por fechas
			if(comboMesDesde.getSelectedIndex() > 0 && !"".equals(textYearDesde.getText())){
				//tengo fecha desde a consultar
				valores.put(CriterioBusquedaBiopsia.FECHA_DESDE, textYearDesde.getText() + "-" + comboMesDesde.getSelectedIndex() + "-" + (comboDiaDesde.getSelectedIndex() + 1));
			}
			if(comboMesHasta.getSelectedIndex() > 0 && !"".equals(textYearHasta.getText())){
				//tengo fecha hasta a consultar
				valores.put(CriterioBusquedaBiopsia.FECHA_HASTA, textYearHasta.getText() + "-" + comboMesHasta.getSelectedIndex() + "-" + (comboDiaHasta.getSelectedIndex() + 1));
			}
			
			List<AuditoriaBiopsiaDTO> results = AuditoriaBiopsiaDAO.searchByDates(valores);
			if(results == null 
					|| (results != null && results.size() == 0)){
				//el listado no trajo resultados
				JOptionPane.showMessageDialog(this, "Para los criterios de búsqueda indicados no se obtuvieron resultados", 
						"No se encontraron resultados", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				AppWindow.getInstance().setPanelContenido(null, 
						JTableAuditoriaBiopsia.getNewInstance(results).getJTable());
			}
		}
	}
}
