<?php

namespace MLSTEAM\MLS;

##Base
use pocketmine\pluginbase;
use pocketmine\event\Listener;

##Player
use pocketmine\Player;

##Server
use pocketmine\Server;

##event
use pocketmine\event\player\PlayerJoinEvent;

##utils
use pocketmine\utils\TextFormat;

##Main
class Main extends Pluginbase implements Listener
{
	public function onEnable()
	{
		$plugin = "MCPELoginSystem";
		$address = "適当.xyz";
		$this->getLogger()->info(TextFormat::GREEN.$plugin."の読み込みが完了しました");
		$this->getLogger()->info(TextFormat::RED.$plugin."の再配布・二次配布は禁止です");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->comment["kick"] = array(
			0 => "あなたの端末情報が変わったようです,"$address."で情報を更新してください",
			1 => "あなたのipアドレスが変わったようです,"$address."で情報を更新してください",
			2 => "同じ名前のプレイヤーがいます",
			3 => "このサーバーはただいま整備中です"
		);
	}
	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$cid = $player->loginData["clientId"];
		$ip = $player->getAddress();
		
	} 
}