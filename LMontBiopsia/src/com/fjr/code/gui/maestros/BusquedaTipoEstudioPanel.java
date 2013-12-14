package com.fjr.code.gui.maestros;

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
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.util.Constants;

import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JButton;

/**
 * 
 * Class: BusquedaBiopsiaPanel
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BusquedaTipoEstudioPanel extends JPanel implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 3518439321990846678L;
	private static final String ACTION_COMMAND_BUSCAR = "buscar";
	private JComboBox comboBox1;
	private JTextField txtValor1;
	private JComboBox comboBox2;
	private JTextField txtValor2;
	
	/**
	 * Create the panel.
	 */
	public BusquedaTipoEstudioPanel() {
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
		
		setSize(1000, 95);
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
			
			List<BiopsiaInfoDTO> results = BiopsiaInfoDAO.searchAllByCriteria(valores);
			
			if(results == null || results.size() == 0){
				//el listado no trajo resultados
				JOptionPane.showMessageDialog(this, "Para los criterios de búsqueda indicados no se obtuvieron resultados", 
						"No se encontraron resultados", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				AppWindow.getInstance().setPanelContenido(null, 
						results);
			}
		}
	}
}
