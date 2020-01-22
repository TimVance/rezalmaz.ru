/*
 * arParams
 * 		PREFIX				- prefix for vars
 * 		FORM_ID				- id form
 * 		TABLE_PROP_ID		- id table with properties
 * 		PROP_COUNT_ID		- id field with count properties
 * 		IBLOCK_ID			- id iblock
 *		LANG				- lang id
 *		TITLE				- window title
 *		OBJ					- object var name
 *		SESS				- session id for get		
 * Variables
 * 		this.PREFIX
 * 		this.PREFIX_TR
 * 		this.FORM_ID
 * 		this.FORM_DATA
 * 		this.TABLE_PROP_ID
 * 		this.PROP_TBL
 * 		this.PROP_COUNT_ID
 * 		this.PROP_COUNT
 * 		this.PROP_COUNT_VALUE
 * 		this.IBLOCK_ID
 * 		this.LANG
 * 		this.TITLE
 * 		this.CELLS
 * 		this.CELL_IND
 * 		this.CELL_CENT
 * 		this.OBJNAME
 * 		this.SESS
 */
function JCIBlockProperty(arParams)
{
	var _this = this;
	
	if (!arParams) return;
	
	this.intERROR = 0;
	this.PREFIX = arParams.PREFIX;
	this.PREFIX_TR = this.PREFIX+'ROW_'; 
	this.FORM_ID = arParams.FORM_ID;
	this.TABLE_PROP_ID = arParams.TABLE_PROP_ID;
	this.PROP_COUNT_ID = arParams.PROP_COUNT_ID;
	this.IBLOCK_ID = arParams.IBLOCK_ID;
	this.LANG = arParams.LANG;
	this.TITLE = arParams.TITLE;
	this.CELLS = [];
	this.CELL_IND = -1;
	this.CELL_CENT = [];
	this.OBJNAME = arParams.OBJ;
	if (!arParams.SESS)
		return;
	this.SESS = arParams.SESS;
	
	BX.ready(BX.delegate(this.Init,this));
}

JCIBlockProperty.prototype.Init = function()
{
	this.FORM_DATA = BX(this.FORM_ID);
	if (!this.FORM_DATA)
	{
		this.intERROR = -1;
		return;
	}
	this.PROP_TBL = BX(this.TABLE_PROP_ID);
	if (!this.PROP_TBL)
	{
		this.intERROR = -1;
		return;
	}
	this.PROP_COUNT = BX(this.PROP_COUNT_ID);
	if (!this.PROP_COUNT)
	{
		this.intERROR = -1;
		return;
	}
	var clButtons = BX.findChildren(this.PROP_TBL, {'tag': 'input','attribute': { 'type':'button'}}, true);
	if (clButtons)
	{
		for (var i = 0; i < clButtons.length; i++)
			BX.bind(clButtons[i], 'click', BX.proxy(function(e){this.ShowPropertyDialog(e);}, this));
	}
}

JCIBlockProperty.prototype.GetPropInfo = function(ID)
{
	if (0 > this.intERROR)
		return;

	ID = this.PREFIX + ID;

	arResult = {
		'FILE_TYPE': this.FORM_DATA[ID+'_FILE_TYPE'].value,
		'LIST_TYPE':  ('C' != this.FORM_DATA[ID+'_LIST_TYPE'].value ? 'L' : 'C'),
		'ROW_COUNT' : this.FORM_DATA[ID+'_ROW_COUNT'].value,
		'COL_COUNT' : this.FORM_DATA[ID+'_COL_COUNT'].value,
		'LINK_IBLOCK_ID' : this.FORM_DATA[ID+'_LINK_IBLOCK_ID'].value,
		'DEFAULT_VALUE' : this.FORM_DATA[ID+'_DEFAULT_VALUE'].value,
		'USER_TYPE_SETTINGS' : this.FORM_DATA[ID+'_USER_TYPE_SETTINGS'].value,
		'WITH_DESCRIPTION' : this.FORM_DATA[ID+'_WITH_DESCRIPTION'].value,
		'SEARCHABLE' : this.FORM_DATA[ID+'_SEARCHABLE'].value,
		'FILTRABLE' : this.FORM_DATA[ID+'_FILTRABLE'].value,
		'ACTIVE' : this.FORM_DATA[ID+'_ACTIVE'].value,
		'MULTIPLE_CNT' : this.FORM_DATA[ID+'_MULTIPLE_CNT'].value,
		'XML_ID' : BX.util.htmlspecialchars(this.FORM_DATA[ID+'_XML_ID'].value),
		'PROPERTY_TYPE' : this.FORM_DATA[ID+'_PROPERTY_TYPE'].value,
		'NAME' : BX.util.htmlspecialchars(this.FORM_DATA[ID+'_NAME'].value),
		'MULTIPLE' : (true == this.FORM_DATA[ID+'_MULTIPLE_Y'].checked ? this.FORM_DATA[ID+'_MULTIPLE_Y'].value : this.FORM_DATA[ID+'_MULTIPLE_N'].value),
		'IS_REQUIRED' : (true == this.FORM_DATA[ID+'_IS_REQUIRED_Y'].checked ? this.FORM_DATA[ID+'_IS_REQUIRED_Y'].value : this.FORM_DATA[ID+'_IS_REQUIRED_N'].value),
		'SORT' : this.FORM_DATA[ID+'_SORT'].value,
		'CODE' : BX.util.htmlspecialchars(this.FORM_DATA[ID+'_CODE'].value)
	};
	if ('L' == arResult.PROPERTY_TYPE)
	{
		arResult.VALUES = null;
		if (this.FORM_DATA[ID+'_VALUES'])
			arResult.VALUES = this.FORM_DATA[ID+'_VALUES'].value;
		arResult.VALUES_DEF = null;
		if (this.FORM_DATA[ID+'_VALUES_DEF'])
			arResult.VALUES_DEF = this.FORM_DATA[ID+'_VALUES_DEF'].value;
		arResult.VALUES_XML = null;
		if (this.FORM_DATA[ID+'_VALUES_XML'])
			arResult.VALUES_XML = this.FORM_DATA[ID+'_VALUES_XML'].value;
		arResult.VALUES_SORT = null;
		if (this.FORM_DATA[ID+'_VALUES_SORT'])
			arResult.VALUES_SORT = this.FORM_DATA[ID+'_VALUES_SORT'].value;
		arResult.CNT = 0;
		if (this.FORM_DATA[ID+'_CNT'])
			arResult.CNT = this.FORM_DATA[ID+'_CNT'].value;
	}
	return arResult;
}

JCIBlockProperty.prototype.SetPropInfo = function(ID,arProp,formsess)
{
	if (0 > this.intERROR)
		return;

	if (!formsess)
		return;
	if (this.SESS != formsess)
		return;

	ID = this.PREFIX+ID;

	this.FORM_DATA[ID+'_NAME'].value = BX.util.htmlspecialcharsback(arProp.NAME);
	this.FORM_DATA[ID+'_SORT'].value = arProp.SORT;
	this.FORM_DATA[ID+'_CODE'].value = BX.util.htmlspecialcharsback(arProp.CODE);
	this.FORM_DATA[ID+'_ROW_COUNT'].value = arProp.ROW_COUNT;
	this.FORM_DATA[ID+'_COL_COUNT'].value = arProp.COL_COUNT;
	this.FORM_DATA[ID+'_LIST_TYPE'].value = arProp.LIST_TYPE;
	this.FORM_DATA[ID+'_FILE_TYPE'].value = arProp.FILE_TYPE;
	this.FORM_DATA[ID+'_MULTIPLE_CNT'].value = arProp.MULTIPLE_CNT;
	this.FORM_DATA[ID+'_LINK_IBLOCK_ID'].value = arProp.LINK_IBLOCK_ID;
	this.FORM_DATA[ID+'_WITH_DESCRIPTION'].value = arProp.WITH_DESCRIPTION;
	this.FORM_DATA[ID+'_XML_ID'].value = BX.util.htmlspecialcharsback(arProp.XML_ID);
	this.FORM_DATA[ID+'_SEARCHABLE'].value = arProp.SEARCHABLE;
	this.FORM_DATA[ID+'_FILTRABLE'].value = arProp.FILTRABLE;
	this.FORM_DATA[ID+'_ACTIVE'].value = arProp.ACTIVE;
	this.FORM_DATA[ID+'_DEFAULT_VALUE'].value = arProp.DEFAULT_VALUE;
	var PropMulti = BX(ID+'_MULTIPLE_Y');
	PropMulti.checked = ('Y' == arProp.MULTIPLE ? true : false);
	var PropReq = BX(ID+'_IS_REQUIRED_Y');
	PropReq.checked = ('Y' == arProp.IS_REQUIRED ? true : false);
	this.FORM_DATA[ID+'_USER_TYPE_SETTINGS'].value = arProp.USER_TYPE_SETTINGS;
	if ('L' == arProp.PROPERTY_TYPE)
	{
		this.FORM_DATA[ID+'_VALUES'].value = arProp.VALUES;
		this.FORM_DATA[ID+'_VALUES_DEF'].value = arProp.VALUES_DEF;
		this.FORM_DATA[ID+'_VALUES_SORT'].value = arProp.VALUES_SORT;
		this.FORM_DATA[ID+'_VALUES_XML'].value = arProp.VALUES_XML;
		this.FORM_DATA[ID+'_CNT'].value = arProp.CNT;
	}
	for (i = 0; i < this.FORM_DATA[ID+'_PROPERTY_TYPE'].length; i++)
		if (arProp.PROPERTY_TYPE == this.FORM_DATA[ID+'_PROPERTY_TYPE'].options[i].value)
			this.FORM_DATA[ID+'_PROPERTY_TYPE'].options[i].selected = true;
}

JCIBlockProperty.prototype.GetProperty = function(strName)
{
	if (0 > this.intERROR)
		return;

	if ((!strName) || (!this[strName])) return;
	return this[strName];
}

JCIBlockProperty.prototype.SetProperty = function(strName,value)
{
	if (0 > this.intERROR)
		return;

	if (strName)
		this[strName] = value;
}

JCIBlockProperty.prototype.JSParamsToPHP = function (ob, varname)
{
	var res, i, key;
	if(typeof(ob)=='object')
	{
		res = [];
		var isSimpleArray = false;
		if(ob instanceof Array)
		{
			isSimpleArray = true;
			for(i in ob)
			{
				if(parseInt(i)!=i)
				{
					isSimpleArray = false;
					break;
				}
			}
		}

		if(isSimpleArray)
		{
			for(i=0; i<ob.length; i++)
				res.push(this.JSParamsToPHP(ob[i], varname+'['+i+']'));
		}
		else
		{
			for(key in ob)
				res.push(this.JSParamsToPHP(ob[key], varname+'['+key+']'));
		}

		return res.join("&", res);
	}

	if(typeof(ob)=='boolean')
	{
		if(ob)
			return varname + '=1';
		return varname + "=0";
	}

	return varname + '=' + BX.util.urlencode(ob);
}

JCIBlockProperty.prototype.ShowPropertyDialog = function (e)
{
	if(!e)
		e = window.event;
	if (0 > this.intERROR)
		return;
	var s = (BX.browser.IsIE() ? e.srcElement.id : e.target.id);
	
	if (!s)
		return;

	s = s.replace(this.PREFIX,'');
	s = s.replace('_BTN','');
	var ID = s;
	
	arProp = this.GetPropInfo(ID);
	if (arProp)
	{
		arParams = {
			'PREFIX': this.PREFIX,
			'ID': ID,
			'IBLOCK_ID': this.IBLOCK_ID,
			'TITLE': this.TITLE,
			'RECEIVER': this.OBJNAME
		};
		(new BX.CAdminDialog({
			'title': this.TITLE,
		    'content_url': '/bitrix/admin/iblock_edit_property.php?lang='+this.LANG+'&propedit='+ID+'&bxpublic=Y&receiver='+this.OBJNAME, 
		    'content_post': this.JSParamsToPHP(arParams, 'PARAMS')+ '&' +
		    this.JSParamsToPHP(arProp, 'PROP')+'&'+this.SESS,
			'draggable': true,
			'resizable': true,
			'buttons': [BX.CAdminDialog.btnSave, BX.CAdminDialog.btnCancel]
		})).Show();
	}
}

JCIBlockProperty.prototype.SetCells = function(arCells,intIndex,arCenter)
{
	if (0 > this.intERROR)
		return;

	if (arCells)
		this.CELLS = BX.clone(arCells,true);
	for (var i = 0; i < this.CELLS.length; i++)
	{
		this.CELLS[i] = this.CELLS[i].replace(/PREFIX/ig, this.PREFIX);
	}
	if (intIndex)
		this.CELL_IND = intIndex;
	if (arCenter)
		this.CELL_CENT = BX.clone(arCenter,true)
}

JCIBlockProperty.prototype.addPropRow = function()
{
	if (0 > this.intERROR)
		return;
	var i = 0;
	var id = parseInt(this.PROP_COUNT.value);

	var newRow = this.PROP_TBL.insertRow(this.PROP_TBL.rows.length)
	newRow.id = this.PREFIX_TR+'n'+id;
	for (i = 0; i < this.CELLS.length; i++)
	{
		var oCell = newRow.insertCell(-1);
		var typeHtml = this.CELLS[i];
		typeHtml = typeHtml.replace(/tmp_xxx/ig, 'n'+id);
		oCell.innerHTML = typeHtml;
	}
	for (i = 0; i < this.CELL_CENT.length; i++)
	{
		var needCell = newRow.cells[this.CELL_CENT[i]-1];
		if (needCell)
		{
			needCell.setAttribute('align','center');
		}
	}
	if (newRow.cells[this.CELL_IND])
	{
		var needCell = newRow.cells[this.CELL_IND];
		var clButtons = BX.findChildren(needCell, {'tag': 'input','attribute': { 'type':'button'}}, true);
		if (clButtons)
		{
			for (var i = 0; i < clButtons.length; i++)
				BX.bind(clButtons[i], 'click', BX.proxy(function(e){this.ShowPropertyDialog(e);}, this));
		}
	}
	this.PROP_COUNT.value = id + 1;
}