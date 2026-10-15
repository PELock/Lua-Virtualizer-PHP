<?php

namespace PELock\LuaVirtualizer;

enum Target: string
{
	case Auto = 'auto';
	case Lua51 = '5.1';
	case Lua52 = '5.2';
	case Lua53 = '5.3';
	case Lua54 = '5.4';
	case Lua55 = '5.5';
	case LuaJit = 'luajit';
	case Luau = 'luau';
}
