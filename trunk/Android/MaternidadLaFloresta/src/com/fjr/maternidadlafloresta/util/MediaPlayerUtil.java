package com.fjr.maternidadlafloresta.util;

import android.content.Context;
import android.media.MediaPlayer;

/**
 * 
 * @author frojas
 *
 */
public class MediaPlayerUtil {
	/**
	 * Single MediaPlayerInstance for the App
	 */
	private static MediaPlayer mp = null;
	
	private MediaPlayerUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Play a sound inside the app.
	 * 
	 * @param resourceId
	 * @param context
	 */
	public static void playSound(int resourceId, Context context){
		if(resourceId > -1){
			if(mp != null){
				mp.release();
			}
			
			mp = MediaPlayer.create(context, resourceId);
			mp.start();
		}
	}
}
