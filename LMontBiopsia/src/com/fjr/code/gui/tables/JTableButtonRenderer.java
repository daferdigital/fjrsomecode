package com.fjr.code.gui.tables;

import java.awt.Component;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.TableCellRenderer;

/**
 * 
 * Class: JTableButtonRenderer
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
class JTableButtonRenderer implements TableCellRenderer { 
	
	@Override 
	public Component getTableCellRendererComponent(JTable table, Object value, boolean isSelected, 
			boolean hasFocus, int row, int column) {
		JButton button = (JButton) value;
		button.setText("<html><b style=\"color: red;\">" + button.getText() + "</b></html>");
		
        return button;  
    }
}
