<?php
 /**
  3 * 取得阅读器名称和版本
  4 *
  5 * @access public
  6 * @return string
  7 */
   function getbrowser()
    {
         global $_SERVER;
     
         $agent= $_SERVER['HTTP_USER_AGENT'];
         $browser= '';
         $browser_ver= '';
     
         if (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs))
         {
             $browser='OmniWeb';
             $browser_ver= $regs[2];
         }
     
         if (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs))
         {
             $browser='Netscape';
             $browser_ver= $regs[2];
         }
     
         if (preg_match('/safari\/([^\s]+)/i', $agent, $regs))
         {
             $browser='Safari';
             $browser_ver=$regs[1];
         }
     
         if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs))
         {
             $browser='Internet Explorer';
             $browser_ver= $regs[1];
         }
     
         if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs))
         {
             $browser='Opera';
             $browser_ver=$regs[1];
         }
     
         if (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs))
         {
             $browser='(Internet Explorer ' .$browser_ver. ') NetCaptor';
             $browser_ver= $regs[1];
         }
     
         if (preg_match('/Maxthon/i', $agent, $regs))
         {
             $browser='(Internet Explorer ' .$browser_ver. ') Maxthon';
             $browser_ver='';
         }
     
         if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs))
         {
             $browser='FireFox';
             $browser_ver=$regs[1];
         }
     
         if (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs))
         {
             $browser='Lynx';
             $browser_ver=$regs[1];
         }
     
         if ($browser != '')
         {
             return $browser;
         }
         else
         {
             return 'Unknow browser';
         }
     }
     ?>