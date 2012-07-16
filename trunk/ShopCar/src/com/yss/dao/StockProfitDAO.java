package com.yss.dao;

import java.util.Iterator;

import org.apache.log4j.Logger;

import com.yss.properties.AppProperties;
import com.yss.properties.AppProperties.AppPropertyNames;
import com.yss.util.WSPortManager;
import com.yss.ws.client.syncws.ArrayOfArticuloStock;
import com.yss.ws.client.syncws.ArticuloStock;
import com.yss.ws.client.syncws.SyncWSSoap;

/**
 * 
 * Class: StockProfitDAO
 * Creation Date: 16/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class StockProfitDAO {
	private static final Logger logger = Logger.getLogger(StockProfitDAO.class);
	
	private StockProfitDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param codProducto
	 * @param cantidadRequerida
	 * @return
	 */
	public static boolean checkStockExistance(String codProducto, int cantidadRequerida){
		final String method = "checkStockExistance('" + codProducto
				+ "', '" + cantidadRequerida + "'): ";
		boolean haveStock = false;
		long t0 = System.currentTimeMillis();
		
		logger.info(method + "Iniciando metodo");
		try {
			SyncWSSoap port = WSPortManager.getSyncWSSoapPort(logger,
					AppProperties.getPropertyValue(AppPropertyNames.APP_wsdlUrlProfitWS));
			logger.info(method + "Obtenido WSPort en " + (System.currentTimeMillis() - t0) + " ms.");
			
			ArrayOfArticuloStock stock = port.stockLista(codProducto);
			logger.info(method + "Obtenida respuesta del WS en " + (System.currentTimeMillis() - t0) + " ms.");
			
			for (Iterator<ArticuloStock> iterator = stock.getArticuloStock().iterator(); iterator.hasNext();) {
				ArticuloStock type = iterator.next();
				if(cantidadRequerida <= type.getCanditad()){
					//tenemos stock para esta peticion
					haveStock = true;
				}
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		logger.info(method + "Finalizando metodo en " + (System.currentTimeMillis() - t0) + " ms. Retornando: " + haveStock);
		return haveStock;
	}
}
