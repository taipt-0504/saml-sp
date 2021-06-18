<?php

// If you choose to use ENV vars to define these values, give this IdP its own env var names
// so you can define different values for each IdP, all starting with 'SAML2_'.$this_idp_env_id
$this_idp_env_id = 'TEST';

//This is variable is for simplesaml example only.
// For real IdP, you must set the url values in the 'idp' config to conform to the IdP's real urls.
$idp_host = env('SAML2_'.$this_idp_env_id.'_IDP_HOST', 'https://sky-premium-pwa.test/saml');

return $settings = array(

    /*****
     * One Login Settings
     */

    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => env('APP_DEBUG', true),

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_SP_x509','MIICWjCCAcOgAwIBAgIBADANBgkqhkiG9w0BAQ0FADBKMQswCQYDVQQGEwJ2bjESMBAGA1UECAwJSMOgIE7hu5lpMQwwCgYDVQQKDANTdW4xGTAXBgNVBAMMEHN1bi1hc3Rlcmlzay5jb20wHhcNMjAwODExMDU1NjAyWhcNMjEwODExMDU1NjAyWjBKMQswCQYDVQQGEwJ2bjESMBAGA1UECAwJSMOgIE7hu5lpMQwwCgYDVQQKDANTdW4xGTAXBgNVBAMMEHN1bi1hc3Rlcmlzay5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAPvD7hP5rZgdERDP+6KdIfxHgPBHHYEVp1UbN3bSKBvlP18+C3q7+BAE/KiHsquZQNaYxA3psMx2b+q9bqIpIJ0RTbbYt8rdBXrkrp9pIHgeOV2CIuEs3qP5fb4d3uHAomMfoqz6fmOJ4E6sEYb7JISsMQ4H0lxBkKyHjfYnF6OxAgMBAAGjUDBOMB0GA1UdDgQWBBS8EwmVPe/VHz7DfcVqsb4vltyWNzAfBgNVHSMEGDAWgBS8EwmVPe/VHz7DfcVqsb4vltyWNzAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBDQUAA4GBAIdwrJLsFB70WYzVk87cmcccWj9YJZ0zkguqmFo0TmGVF3keuVKu1a14lyhS07nZcGoEkP29D+OJCTCfLSfMDfc8kjJMV+AWEuwNpUZtkQRjZF2JT4F+LEPSn+qkRxCdA90TYeeBpOi4lRhQi1AW0PLY3FV9gT0PZ7GFFT6MySde'),
        'privateKey' => env('SAML2_'.$this_idp_env_id.'_SP_PRIVATEKEY','MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAPvD7hP5rZgdERDP+6KdIfxHgPBHHYEVp1UbN3bSKBvlP18+C3q7+BAE/KiHsquZQNaYxA3psMx2b+q9bqIpIJ0RTbbYt8rdBXrkrp9pIHgeOV2CIuEs3qP5fb4d3uHAomMfoqz6fmOJ4E6sEYb7JISsMQ4H0lxBkKyHjfYnF6OxAgMBAAECgYBjnau29aStOlsFRvXu6rOGyZgH+mt/Jt01vHYeqpq6JuQDQF50aqmFVSPPXxnf8dyIzJtOUfflfrtbqyZ6PUGse0K+ODJ3H+rIt0MwG+QwTd9Haj1q20Gq+C9fIYcQGRGnrx0nctL/oKyPHSjUZ4bCCBQQBBMgX6lfZM6dpXU+fQJBAP+jivIXKLL5GIF+qW1gmwg4xUJpjMVEFMipbhjXNkNpT1XmyG1pDVUrrO1fSV6kSIqrL3jTlMvXmDZfMaCI0SsCQQD8Hvx+k3NgGbSsTY31JtwlwLpGF+BUK3aozgBDC9HpOpwlsk+gemVDsym1sXcOFzKJYRB2Q3n2xuFfvotOApiTAkBcqx86JPUG889TWeP3F1b7wwCW04ZJGCXkm66iaJluFGXDAPbU2okPv9Ze8fS5zxnQ0r9RsHk2739o7lciF5ajAkEAlG7JyNuWuaVosWiXgxV11uQ4xruX3vYXzho6HT8APoe7FpZ8OsbUh58bl1T7+te9cRQsVPQ1Agzk8zGDYlI08QJBAMUCAhJHYEgyMoXoRRbrEsrcdtWv009J8GiYasq5mWTys8oASIR6v5hC3TwrfWIdvFqoU2OBmEOu44JZXrFQjfA='),

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        'entityId' => env('SAML2_'.$this_idp_env_id.'_SP_ENTITYID',''),

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => '',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => '',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => env('SAML2_'.$this_idp_env_id.'_IDP_ENTITYID', $idp_host . ''),
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.
            'url' => env('SAML2_'.$this_idp_env_id.'_IDP_SSO_URL', $idp_host . ''),
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.
            'url' => env('SAML2_'.$this_idp_env_id.'_IDP_SL_URL', $idp_host . '/saml2/idp/SingleLogoutService.php'),
        ),
        // Public x509 certificate of the IdP
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_IDP_x509', 'MIICRjCCAa+gAwIBAgIBADANBgkqhkiG9w0BAQ0FADBAMQswCQYDVQQGEwJ2bjER
        MA8GA1UECAwIQ2F1IGdpYXkxDDAKBgNVBAoMA1N1bjEQMA4GA1UEAwwHc3VuLmNv
        bTAeFw0yMTA2MTUwOTI0MzRaFw0zMTA2MTMwOTI0MzRaMEAxCzAJBgNVBAYTAnZu
        MREwDwYDVQQIDAhDYXUgZ2lheTEMMAoGA1UECgwDU3VuMRAwDgYDVQQDDAdzdW4u
        Y29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDWG52gwSDnX7KhZ2JJsxGq
        lWoXmalFZoeprabpDi7jaNz3i5NkPY/FTh8Bp4+HNWtWO2bEsvoXP33ZRs2wHunA
        8qSUZjlWk+jlBPQAJawyfFp/XJyBl7MvY6g2L0CO7n9ecSlboSXXftPMYb4GF8oC
        LjV1DtiKVZ6p+wSFgBLuhwIDAQABo1AwTjAdBgNVHQ4EFgQUIMOiFXibUGFsFfzZ
        pc6HSk/1o78wHwYDVR0jBBgwFoAUIMOiFXibUGFsFfzZpc6HSk/1o78wDAYDVR0T
        BAUwAwEB/zANBgkqhkiG9w0BAQ0FAAOBgQBjCDP3N7NrIPw9b4Qw6jnC3IjZFnpk
        B4fBMtdZW1IyrWd0vKc987lTFpSRnWnm4utRFO+KxaEYAdCN2R/jQhrNdtGVQANk
        piJJW4rUP0iCfJnGbvWYWd6sX5UmpP6O3chMP5plJCQ0RWwS38CDiR2xRbKntXJ7
        iXMCPeaH2s2G8A=='),
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
    ),



    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => true,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => false,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => false,

        /* Sign the Metadata
         False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => false,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => false,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => false,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,
        'signatureAlgorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha512',
        'digestAlgorithm' => 'http://www.w3.org/2001/04/xmlenc#sha512',
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        'technical' => array(
            'givenName' => 'name',
            'emailAddress' => 'no@reply.com'
        ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => 'no@reply.com'
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'Name',
            'displayname' => 'Display Name',
            'url' => 'http://url'
        ),
    ),

/* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

   'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                      // MUST NOT assume that the IdP validates the sign
   'wantAssertionsSigned' => true,
   'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
   'wantNameIdEncrypted' => false,
*/

);
