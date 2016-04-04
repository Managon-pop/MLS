<?php

namespace MLSTEAM\MLS;

##Base
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

##Player
use pocketmine\Player;

##Server
use pocketmine\Server;

##event
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerPreLoginEvent;

##utils
//use pocketmine\utils\TextFormat;//§を使えば要らないんじゃない？

##Main
class Main extends Pluginbase implements Listener
{
	const VERSION = "1.0";
	
	const PLUGIN = "MCPELoginSystem";
	const URL = "";//ホームページなどを作ったら入れます。Managon.
	
	public function onEnable()
	{
		$address = "適当.xyz";
		$this->getLogger()->info("§2".self::PLUGIN."の読み込みが完了しました");
		$this->getLogger()->info("§c".self::PLUGIN."の再配布・二次配布は禁止です");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->comment["kick"] = array(
			0 => "あなたの端末情報が変わったようです,".$address."で情報を更新してください",
			1 => "あなたのipアドレスが変わったようです,".$address."で情報を更新してください",
			2 => "同じ名前のプレイヤーがいます",
			3 => "このサーバーはただいま整備中です"
		);
	}
	public function onLogin(PlayerPreLoginEvent $event)
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$cid = $player->loginData["clientId"];
		$ip = $player->getAddress();
		//ここらへんのDBは、他の人に任せます ogiwara
		
	} 
	
}
