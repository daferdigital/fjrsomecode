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

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.CriterioBusquedaBiopsia;
import com.fjr.code.dao.definitions.Meses;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.tables.JTableInformeComplementario;
import com.fjr.code.util.Constants;

import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JButton;
import javax.swing.SwingConstants;

/**
 * 
 * Class: InformeComplementarioPanel
 * Creation Date: 04/03/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class InformeComplementarioPanel extends JPanel implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 3518439321990846678L;
	private static final String ACTION_COMMAND_BUSCAR = "buscar";
	
	private JComboBox comboBox1;
	private JTextField txtValor1;
	private JComboBox comboBox2;
	private JTextField txtValor2;
	private JComboBox comboBox3;
	private JTextField txtValor3;
	private JComboBox comboDiaDesde;
	private JComboBox comboMesDesde;
	private JTextField textYearDesde;
	private JComboBox comboDiaHasta;
	private JComboBox comboMesHasta;
	private JTextField textYearHasta;

	/**
	 * Create the panel.
	 */
	public InformeComplementarioPanel() {
		setLayout(null);
		
		JLabel lblCriterioDeBsqueda = new JLabel("<html><b>Criterio de B&uacute;squeda 1:</b></html>");
		lblCriterioDeBsqueda.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblCriterioDeBsqueda.setBounds(10, 11, 172, 16);
		add(lblCriterioDeBsqueda);
		
		comboBox1 = new JComboBox();
		comboBox1.setBounds(192, 10, 232, 20);
		for (int i = 0; i < CriterioBusquedaBiopsia.values().length; i++) {
			if(CriterioBusquedaBiopsia.values()[i].isShowInCombo()){
				comboBox1.addItem(CriterioBusquedaBiopsia.values()[i]);
			}
		}
		add(comboBox1);
		
		setSize(1000, 125);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JLabel lblvalorABuscar = new JLabel("<html><b>Valor a Buscar:</b></html>");
		lblvalorABuscar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblvalorABuscar.setBounds(452, 11, 108, 16);
		add(lblvalorABuscar);
		
		txtValor1 = new JTextField();
		txtValor1.setBounds(572, 10, 232, 20);
		add(txtValor1);
		txtValor1.setColumns(10);
		
		JButton btnBuscar = new JButton("Buscar");
		btnBuscar.setActionCommand(ACTION_COMMAND_BUSCAR);
		btnBuscar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnBuscar.setBounds(812, 9, 89, 23);
		btnBuscar.addActionListener(this);
		add(btnBuscar);
		
		JLabel lblcriterioDeBuacutesqueda = new JLabel("<html><b>Criterio de B&uacute;squeda 2:</b></html>");
		lblcriterioDeBuacutesqueda.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblcriterioDeBuacutesqueda.setBounds(10, 39, 172, 16);
		add(lblcriterioDeBuacutesqueda);
		
		comboBox2 = new JComboBox();
		comboBox2.setBounds(192, 38, 232, 20);
		for (int i = 0; i < CriterioBusquedaBiopsia.values().length; i++) {
			if(CriterioBusquedaBiopsia.values()[i].isShowInCombo()){
				comboBox2.addItem(CriterioBusquedaBiopsia.values()[i]);
			}
		}
		add(comboBox2);
		
		JLabel label_1 = new JLabel("<html><b>Valor a Buscar:</b></html>");
		label_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		label_1.setBounds(452, 39, 108, 16);
		add(label_1);
		
		txtValor2 = new JTextField();
		txtValor2.setColumns(10);
		txtValor2.setBounds(572, 38, 232, 20);
		add(txtValor2);
		
		JLabel lblcriterioDeBuacutesqueda_1 = new JLabel("<html><b>Criterio de B&uacute;squeda 3:</b></html>");
		lblcriterioDeBuacutesqueda_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblcriterioDeBuacutesqueda_1.setBounds(10, 67, 172, 16);
		add(lblcriterioDeBuacutesqueda_1);
		
		comboBox3 = new JComboBox();
		comboBox3.setBounds(192, 66, 232, 20);
		for (int i = 0; i < CriterioBusquedaBiopsia.values().length; i++) {
			if(CriterioBusquedaBiopsia.values()[i].isShowInCombo()){
				comboBox3.addItem(CriterioBusquedaBiopsia.values()[i]);
			}
		}
		add(comboBox3);
		
		JLabel label_3 = new JLabel("<html><b>Valor a Buscar:</b></html>");
		label_3.setFont(new Font("Tahoma", Font.PLAIN, 13));
		label_3.setBounds(452, 67, 108, 16);
		add(label_3);
		
		txtValor3 = new JTextField();
		txtValor3.setColumns(10);
		txtValor3.setBounds(572, 66, 232, 20);
		add(txtValor3);
		
		JLabel lblfechaDesde = new JLabel("<html><b>Fecha Desde:</b></html>");
		lblfechaDesde.setHorizontalAlignment(SwingConstants.RIGHT);
		lblfechaDesde.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblfechaDesde.setBounds(10, 94, 152, 16);
		add(lblfechaDesde);
		
		comboDiaDesde = new JComboBox();
		comboDiaDesde.setBounds(192, 94, 42, 20);
		for (int i = 1; i < 32; i++) {
			comboDiaDesde.addItem(i < 10 ? "0" + i: i);
		}
		add(comboDiaDesde);
		
		comboMesDesde = new JComboBox();
		comboMesDesde.setBounds(244, 94, 111, 20);
		for (int i = 0; i < Meses.values().length; i++) {
			comboMesDesde.addItem(Meses.values()[i]);
		}
		add(comboMesDesde);
		
		textYearDesde = new JTextField();
		textYearDesde.setBounds(377, 94, 47, 20);
		add(textYearDesde);
		textYearDesde.setColumns(10);
		
		JLabel lblfechaHasta = new JLabel("<html><b>Fecha Hasta:</b></html>");
		lblfechaHasta.setHorizontalAlignment(SwingConstants.RIGHT);
		lblfechaHasta.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblfechaHasta.setBounds(389, 94, 152, 16);
		add(lblfechaHasta);
		
		comboDiaHasta = new JComboBox();
		comboDiaHasta.setBounds(572, 94, 42, 20);
		for (int i = 1; i < 32; i++) {
			comboDiaHasta.addItem(i < 10 ? "0" + i: i);
		}
		add(comboDiaHasta);
		
		comboMesHasta = new JComboBox();
		comboMesHasta.setBounds(623, 94, 111, 20);
		for (int i = 0; i < Meses.values().length; i++) {
			comboMesHasta.addItem(Meses.values()[i]);
		}
		add(comboMesHasta);
		
		textYearHasta = new JTextField();
		textYearHasta.setColumns(10);
		textYearHasta.setBounds(744, 94, 59, 20);
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
			valores.put((CriterioBusquedaBiopsia) comboBox1.getSelectedItem(), txtValor1.getText());
			valores.put((CriterioBusquedaBiopsia) comboBox2.getSelectedItem(), txtValor2.getText());
			valores.put((CriterioBusquedaBiopsia) comboBox3.getSelectedItem(), txtValor3.getText());
			
			//verificamos si debemos buscar tambien por fechas
			if(comboMesDesde.getSelectedIndex() > 0 && !"".equals(textYearDesde.getText())){
				//tengo fecha desde a consultar
				valores.put(CriterioBusquedaBiopsia.FECHA_DESDE, textYearDesde.getText() + "-" + comboMesDesde.getSelectedIndex() + "-" + (comboDiaDesde.getSelectedIndex() + 1));
			}
			if(comboMesHasta.getSelectedIndex() > 0 && !"".equals(textYearHasta.getText())){
				//tengo fecha hasta a consultar
				valores.put(CriterioBusquedaBiopsia.FECHA_HASTA, textYearHasta.getText() + "-" + comboMesHasta.getSelectedIndex() + "-" + (comboDiaHasta.getSelectedIndex() + 1));
			}
			valores.put(CriterioBusquedaBiopsia.FASES_DE_ENTREGA, "");
			
			List<BiopsiaInfoDTO> results = BiopsiaInfoDAO.searchAllByCriteria(valores);
			
			if(results == null 
					|| (results != null && results.size() == 0)){
				//el listado no trajo resultados
				JOptionPane.showMessageDialog(this, "Para los criterios de búsqueda indicados no se obtuvieron resultados", 
						"No se encontraron resultados", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				AppWindow.getInstance().setPanelContenido(null, 
						JTableInformeComplementario.getNewInstance(results).getJTable());
			}
		}
	}
}
