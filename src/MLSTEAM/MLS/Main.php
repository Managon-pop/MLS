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
use pocketmine\utils\TextFormat;//入れといて損はない(*´・ω・)

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
		if(isset($this->LC[$name])){
			$loginData = $this->LC[$name];
			if(!($cid == $loginData[0] && $ip == $loginData[1])){
				$this->LM[$name] = "データベースに接続してログイン";
				//キャッシュのデータと合わなかったときの処理(データベースに接続)
			}else{
				$this->LM[$name] = "キャッシュによりログイン";
			}
		}else{
			$this->LM[$name] = "無理やりログイン";//本来ならここでデータベースに接続します
		}
	}
	
	/*
	           public function onJoin(PlayerJoinEvent $event){
           	    	$player = $event->getPlayer();
    				      $name = $player->getName();
    				      $time = date("m月j日: H時i分s秒");
                  date_default_timezone_set('Asia/Tokyo');
                  $task = new time($this, $player);//インスタンス作成
                  $this->getServer()->getScheduler()->scheduleRepeatingTask($task, 20);

                    if(date("H") >= 5 and date("H") <= 11){
                      $player->sendMessage(TextFormat::YELLOW."[ 時報: ".$time."]§bおはようございます!!\n§b今日もこのサーバーを宜しくお願いします♪");
                    }elseif(date("H") >= 12 and date("H") <= 17){
                      $player->sendMessage(TextFormat::YELLOW."[ 時報: ".$time."]§bこんにちは〜\n§bゆっくりしていってくださいね!!");
    				        }elseif(date("H") >= 18 and date("H") <= 24){
    					         $player->sendMessage(TextFormat::YELLOW."[ 時報: ".$time."]§bこんばんは〜\n§b今日も１日お疲れなのです!!");
    				        }elseif(date("H") >= 1 and date("H") <= 4){
    					         $player->sendMessage(TextFormat::YELLOW."[ 時報: ".$time."]§bこんな夜遅くまでゲームをしていたら体調を崩しますよ!?\n§bほどほどにしておいてくださいね♪");
                     }
                   }
                 }
                 */
	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$cid = $player->loginData["clientId"];
		$ip = $player->getAddress();
		$loginData = array($cid, $ip);//ここで
		$this->LC[$name] = $loginData;//キャッシュを作成
		$player->sendMessage($this->LM[$name]);
	}
}
