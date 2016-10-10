﻿using ModernHttpClient;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Net.Http;
using System.Threading.Tasks;
using static LiveWell.ConnectHelpers;

namespace LiveWell
{
	class DatabaseConnect
	{
		public async Task<List<Notification>> getNotifications(int residentID)
		{
			var getNotifications = new HttpClient(new NativeMessageHandler());
			getNotifications.BaseAddress = new Uri("http://proj-309-la-04.cs.iastate.edu/getNotifications.php");

			HttpResponseMessage gotNotifications = await getNotifications.GetAsync(new Uri("http://proj-309-la-04.cs.iastate.edu/getNotifications.php?residentID=" + residentID));
			String data = await gotNotifications.Content.ReadAsStringAsync();
			Debug.WriteLine(@data);
			List<Notification> notifications = JsonConvert.DeserializeObject<List<Notification>>(data);
			Debug.WriteLine(@notifications);
			return notifications;
		}

		public async Task<List<Address>> getAddress(int buildingID)
		{
			var getAddress = new HttpClient(new NativeMessageHandler());
			getAddress.BaseAddress = new Uri("http://proj-309-la-04.cs.iastate.edu/getBuilding.php");

			HttpResponseMessage gotAddress = await getAddress.GetAsync(new Uri("http://proj-309-la-04.cs.iastate.edu/getBuilding.php?buildingID=" + buildingID));
			String data = await gotAddress.Content.ReadAsStringAsync();
			Debug.WriteLine(@data);
			List<Address> addresses = JsonConvert.DeserializeObject<List<Address>>(data);
			Debug.WriteLine(@addresses);
			return addresses;
		}
	}
}