package com.carrito.dto;

/**
 * 
 * Class: CarritoItemDTO
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class CarritoItemDTO {
	private int productId;
	private String productName;
	private int userId;
	private double productPrice;
	private int cantidad;
	
	public CarritoItemDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getProductId() {
		return productId;
	}

	public void setProductId(int productId) {
		this.productId = productId;
	}

	public String getProductName() {
		return productName;
	}

	public void setProductName(String productName) {
		this.productName = productName;
	}

	public int getUserId() {
		return userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	public double getProductPrice() {
		return productPrice;
	}

	public void setProductPrice(double productPrice) {
		this.productPrice = productPrice;
	}
	
	public int getCantidad() {
		return cantidad;
	}
	
	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}

	@Override
	public String toString() {
		return "CarritoItemDTO [productId=" + productId + ", productName="
				+ productName + ", userId=" + userId + ", productPrice="
				+ productPrice + ", cantidad=" + cantidad + "]";
	}
}
